package com.hcmus.dreamers.foodmap;

import android.app.Dialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GoogleApiAvailability;
import com.hcmus.dreamers.foodmap.Model.TaskCompleteCallbacks;
import com.hcmus.dreamers.foodmap.Model.TaskHttpRequest;

import java.util.HashMap;

public class MainActivity extends AppCompatActivity{

    private static final int CODE_REQUEST = 9999;

    @Override
    protected void onCreate(Bundle savedInstanceState)  {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        TaskHttpRequest httpRequest = new TaskHttpRequest("http://foodmap.tk/login.php", TaskHttpRequest.POST,9090);
        httpRequest.setOnTaskComplete(new TaskCompleteCallbacks() {
            @Override
            public void OnTaskComplete(int codeRequest, String responde) {
                Toast.makeText(MainActivity.this,responde,Toast.LENGTH_LONG).show();
            }
        });

        HashMap<String, String> params = new HashMap<>();
        params.put("username","phuocpr123");
        params.put("password","123");

        httpRequest.execute(params);
        /*
        if (isGooglePlayServicesAvailable()){
            Intent intent = new Intent(MainActivity.this, MapsActivity.class);
            startActivity(intent);
        }*/
    }

    boolean isGooglePlayServicesAvailable(){
        int available = 0;
        GoogleApiAvailability.getInstance().isGooglePlayServicesAvailable(MainActivity.this, available);

        if (available == ConnectionResult.SUCCESS){
            return true;
        }
        else if (GoogleApiAvailability.getInstance().isUserResolvableError(available)){
            Dialog dialog = GoogleApiAvailability.getInstance().getErrorDialog(MainActivity.this,available,CODE_REQUEST);
            dialog.show();
        }
        else {
            Toast.makeText(this,"Can't make map request", Toast.LENGTH_SHORT).show();
        }
        return false;
    }

}
