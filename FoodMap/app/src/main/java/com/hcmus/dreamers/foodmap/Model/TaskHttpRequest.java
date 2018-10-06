package com.hcmus.dreamers.foodmap.Model;

import android.os.AsyncTask;
import android.util.Log;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Map;

public class TaskHttpRequest extends AsyncTask<HashMap<String, String>, Void, String> {

    public static final int GET = 0;
    public static final int POST = 1;

    private String urlRequest;
    private int typeRequest;
    private int requestCode;
    private TaskCompleteCallbacks onCompleteCallbacks;

    public TaskHttpRequest(String urlRequest, int typeRequest, int requestCode) {
        this.urlRequest = urlRequest;
        this.typeRequest = typeRequest;
        this.requestCode = requestCode;

        onCompleteCallbacks = null;
    }

    @Override
    protected String doInBackground(HashMap<String, String>... params) {

        return request(params[0]);
    }

    private String request(HashMap<String, String> params){
        String response = "";
        HttpURLConnection httpURLConnection = null;
        try {
            URL url = new URL(urlRequest);

            httpURLConnection = (HttpURLConnection) url.openConnection();

            httpURLConnection.setConnectTimeout(15000); //15s
            httpURLConnection.setReadTimeout(15000); // 15s

            if (typeRequest == GET){
                httpURLConnection.setRequestMethod("GET");
            }
            else if (typeRequest == POST){
                httpURLConnection.setRequestMethod("POST");

                OutputStream os = httpURLConnection.getOutputStream();
                BufferedWriter bw = new BufferedWriter(new OutputStreamWriter(os, "UTF-8"));

                bw.write(getParamsString(params));
                bw.flush();

                bw.close();
                os.close();
            }

            int responseCode = httpURLConnection.getResponseCode();
            if (responseCode == HttpURLConnection.HTTP_OK){
                String line = "";
                BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(httpURLConnection.getInputStream()));

                while ((line=bufferedReader.readLine()) != null) {
                    response+=line;
                }

                bufferedReader.close();
            }
            else{
                response = "";
            }

        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            if (httpURLConnection != null)
                httpURLConnection.disconnect();
        }

        return response;
    }


    private String getParamsString(HashMap<String, String> params) throws UnsupportedEncodingException {
        StringBuffer paramString = new StringBuffer();

        boolean isFirst = true;

        for (Map.Entry<String, String> param:params.entrySet()) {
            if (isFirst){
                isFirst = false;
            }
            else {
                paramString.append("&");
            }

            paramString.append(URLEncoder.encode(param.getKey(), "UTF-8").toString());
            paramString.append("=");
            paramString.append(URLEncoder.encode(param.getValue(), "UTF-8").toString());
        }
        return paramString.toString();
    }

    @Override
    protected void onPostExecute(String s) {
        super.onPostExecute(s);
        if (onCompleteCallbacks != null){
            onCompleteCallbacks.OnTaskComplete(requestCode, s);
        }
    }

    public void setOnTaskComplete(TaskCompleteCallbacks onCompleteCallbacks){
        this.onCompleteCallbacks = onCompleteCallbacks;
    }
}
