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

        if (isGooglePlayServicesAvailable()){
            Intent intent = new Intent(MainActivity.this, MapsActivity.class);
            startActivity(intent);
        }
    }

    boolean isGooglePlayServicesAvailable(){
        int available = GoogleApiAvailability.getInstance().isGooglePlayServicesAvailable(MainActivity.this);

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
