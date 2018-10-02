package com.study.android.foodmap;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.SparseIntArray;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.Toast;

public class DishActivity extends AppCompatActivity {

    private EditText edtName;
    private EditText edtPrice;
    private Spinner spnCatalog;
    private ImageView imgFood;
    private ImageButton btnSubmit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dish);
        references();

        btnSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(DishActivity.this, "Submit", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void references(){
        edtName = (EditText) findViewById(R.id.edtName);
        edtPrice = (EditText) findViewById(R.id.edtPrice);
        spnCatalog  = (Spinner)findViewById(R.id.spnCatalog);
        imgFood = (ImageView) findViewById(R.id.imgFood);
        btnSubmit = (ImageButton) findViewById(R.id.btnSubmit);
    }
}
