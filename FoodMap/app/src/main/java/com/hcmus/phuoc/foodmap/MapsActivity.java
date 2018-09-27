package com.hcmus.phuoc.foodmap;

import android.Manifest;
import android.app.Dialog;
import android.content.pm.PackageManager;
import android.location.Location;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.support.v4.content.ContextCompat;
import android.util.Log;
import android.widget.Toast;

import com.google.android.gms.common.api.Status;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.places.AutocompleteFilter;
import com.google.android.gms.location.places.Place;
import com.google.android.gms.location.places.ui.PlaceAutocompleteFragment;
import com.google.android.gms.location.places.ui.PlaceSelectionListener;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;


public class MapsActivity extends FragmentActivity implements OnMapReadyCallback, GoogleMap.OnMarkerClickListener{


    private static final String TAG = "MapsActivity";
    private static final String FINE_PERMISSION = Manifest.permission.ACCESS_FINE_LOCATION;
    private static final String COARSE_PERMISSION = Manifest.permission.ACCESS_COARSE_LOCATION;
    private static final int CODE_REQUEST_PERMISSION = 1234;
    private static final float DEFAULT_ZOOM = 15f;

    private GoogleMap mMap;
    private boolean isGooglePermissionGranted = false;
    private FusedLocationProviderClient mFusedLocationProviderClient;

    //private GeoDataClient mGeoDataClient;
    private Marker marker;
    private String modeTrans = "driving";

    //private AutoCompleteTextView actxtSearch;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);

        checkPermission();
    }

    void initMaps() {
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);

        /*
        actxtSearch = (AutoCompleteTextView)findViewById(R.id.actxvSearch);
        actxtSearch.setOnEditorActionListener(new TextView.OnEditorActionListener() {
            @Override
            public boolean onEditorAction(TextView v, int actionId, KeyEvent keyEvent) {
                if (actionId == EditorInfo.IME_ACTION_DONE || actionId == EditorInfo.IME_ACTION_SEARCH
                        || keyEvent.getAction() == KeyEvent.ACTION_DOWN
                        || keyEvent.getAction() == KeyEvent.KEYCODE_ENTER){
                    geoLocation();
                }
                return false;
            }
        });*/
        PlaceAutocompleteFragment autocompleteFragment = (PlaceAutocompleteFragment)
                getFragmentManager().findFragmentById(R.id.place_autocomplete_fragment);

        AutocompleteFilter typeFilter = new AutocompleteFilter.Builder()
                .setCountry("VN")
                .build();
        autocompleteFragment.setFilter(typeFilter);
        autocompleteFragment.setOnPlaceSelectedListener(new PlaceSelectionListener() {
            @Override
            public void onPlaceSelected(Place place) {
                // TODO: Get info about the selected place.
                if (marker != null)
                    marker.remove();
                marker = addMarker(place.getLatLng(), place.getName().toString());
                moveCamera(place.getLatLng(), DEFAULT_ZOOM);
            }

            @Override
            public void onError(Status status) {
                // TODO: Handle the error.
                Log.i(TAG, "An error occurred: " + status);
            }
        });
    }

    /*void geoLocation(){
        String address = actxtSearch.getText().toString();
        Geocoder geocoder = new Geocoder(MapsActivity.this);
        List<Address> listAddress = new ArrayList<>();

        try{
            listAddress = geocoder.getFromLocationName(address, 1);
        }
        catch(IOException e){
            Log.e(TAG, "geoLocation: "+ e.getMessage());
        }

        if (listAddress.size() > 0){
            mMap.clear();
            LatLng latLng = new LatLng(listAddress.get(0).getLatitude(), listAddress.get(0).getLongitude());
            addMarker(latLng, listAddress.get(0).getLocality());
            moveCamera(latLng, DEFAULT_ZOOM);
        }
    }*/

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        if (isGooglePermissionGranted) {
            getDeviceLocal();

            if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
                    && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                return;
            }
            mMap.setMyLocationEnabled(true);
            mMap.getUiSettings().setMyLocationButtonEnabled(false);
            mMap.getUiSettings().setZoomControlsEnabled(true);
        }
        mMap.setOnMarkerClickListener(this);
    }

    public String getUrlApi(LatLng sour, LatLng dest){
        String urlApi = getString(R.string.DirectionAPI);
        String orn = "origin=" + sour.latitude + "," + sour.longitude;
        String des = "destination=" + dest.latitude + "," + dest.longitude;
        String mode = "mode=" + modeTrans;
        return urlApi + orn +"&" + des + "&" +mode +"key=" + getString(R.string.google_maps_key);
    }

    public String requestDirection(String reqUrl) throws IOException {
        String response = "";
        InputStream inputStream = null;
        HttpURLConnection httpURLConnection = null;

        try{
            URL url = new URL(reqUrl);
            httpURLConnection = (HttpURLConnection) url.openConnection();
            httpURLConnection.connect();

            // Get the response result
            inputStream = httpURLConnection.getInputStream();
            InputStreamReader inputStreamReader = new InputStreamReader(inputStream);
            BufferedReader bufferedReader = new BufferedReader(inputStreamReader);

            StringBuffer stringBuffer = new StringBuffer();
            String line = "";
            while((line = bufferedReader.readLine()) != null){
                stringBuffer.append(line);
            }

            response = stringBuffer.toString();
            bufferedReader.close();
            inputStreamReader.close();
        }
        catch (Exception e){
            Log.e(TAG, "requestDirection: exception " + e.getMessage());
        }
        finally {
            if (inputStream!=null){
                inputStream.close();
                httpURLConnection.disconnect();
            }
        }
        return response;
    }

    void getDeviceLocal(){
        mFusedLocationProviderClient = LocationServices.getFusedLocationProviderClient(this);
        try{
            Task location = mFusedLocationProviderClient.getLastLocation();
            location.addOnCompleteListener(new OnCompleteListener() {
                @Override
                public void onComplete(@NonNull Task task) {
                    if (task.isSuccessful()){
                        Location currentLocation = (Location)task.getResult();
                        moveCamera(new LatLng(currentLocation.getLatitude(), currentLocation.getLongitude()), DEFAULT_ZOOM);
                    }
                    else{
                        Log.e(TAG, "onComplete: Current location is null");
                        Toast.makeText(MapsActivity.this, "Unable get your location", Toast.LENGTH_SHORT);
                    }
                }
            });
        }
        catch (SecurityException e){
            Log.e(TAG, "getDeviceLocal: " + e.getMessage());
        }
    }

    void moveCamera(LatLng latLng, float zoom){
        mMap.moveCamera((CameraUpdateFactory.newLatLngZoom(latLng, zoom)));
    }
    Marker addMarker(LatLng latLng, String title){
        return mMap.addMarker(new MarkerOptions()
                            .position(latLng)
                            .title(title));
    }

    void checkPermission(){
        String[] permissions = {Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION};

        if (ContextCompat.checkSelfPermission(this, FINE_PERMISSION) == PackageManager.PERMISSION_GRANTED){
            if (ContextCompat.checkSelfPermission(this, COARSE_PERMISSION) == PackageManager.PERMISSION_GRANTED){
                isGooglePermissionGranted = true;
                initMaps();

                Log.e(TAG, "checkPerrmission: OK");
            }
            else{
                Log.e(TAG, "checkPerrmission: Request Permission");
                ActivityCompat.requestPermissions(this, permissions, CODE_REQUEST_PERMISSION);
            }
        }
        else{
            Log.e(TAG, "checkPerrmission: Request Permission");
            ActivityCompat.requestPermissions(this,permissions, CODE_REQUEST_PERMISSION);
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        isGooglePermissionGranted = false;

        if (requestCode == CODE_REQUEST_PERMISSION){
            int n = permissions.length;
            for (int i = 0; i <n; i++){
                if (grantResults[i] != PackageManager.PERMISSION_GRANTED){
                    return;
                }
            }

            isGooglePermissionGranted = true;
            initMaps();
        }
    }

    @Override
    public boolean onMarkerClick(Marker marker) {
        Log.e(TAG, "onMarkerClick: ");
        return true;
    }

    public class TaskGetDirection extends AsyncTask<String, Void, String>{

        @Override
        protected String doInBackground(String... strings) {
            String url = strings[0];
            try {
                return requestDirection(url);
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            // parse json

        }
    }

}
