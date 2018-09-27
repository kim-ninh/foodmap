package com.hcmus.phuoc.foodmap;

import android.support.annotation.Nullable;
import android.util.Log;

import com.google.android.gms.wallet.fragment.WalletFragmentStyle;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class JsonParse {
    private static final String TAG = "JsonParse";

    @Nullable
    public static ArrayList<HashMap<String, String>> polylineParser(String strJson) {

        if (strJson != null){
            try{
                JSONObject jsonObject = new JSONObject(strJson);
                //JSONArray

            }
            catch (JSONException e){
                Log.e(TAG, "polylineParser: " + e.getMessage());
            }

        }
        return null;
    }



}
