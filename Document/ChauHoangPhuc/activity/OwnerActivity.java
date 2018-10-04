package com.study.android.foodmap;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class OwnerActivity extends AppCompatActivity {
    private EditText edtUsername;
    private EditText edtPassword;
    private Button btnLogin;
    private Button btnSignUp;
    private EditText edtName;
    private EditText edtPhone;
    private EditText edtEmail;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_owner);

        referenceLoginActivity();


    }


    private  void referenceLoginActivity(){
        edtUsername     = (EditText) findViewById(R.id.edtUsername);
        edtPassword     = (EditText) findViewById(R.id.edtPassword);
        btnLogin        = (Button) findViewById(R.id.btnDangNhap);
        btnSignUp       = (Button) findViewById(R.id.btnDangKi);
        btnSignUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setContentView(R.layout.activity_signup_owner);
                referenceSignUpActivity();
            }
        });
    }

    private  void referenceSignUpActivity(){
        edtUsername     = (EditText) findViewById(R.id.edtUsername);
        edtPassword     = (EditText) findViewById(R.id.edtPassword);
        edtName         = (EditText) findViewById(R.id.edtName);
        edtPhone        = (EditText) findViewById(R.id.edtPhone);
        edtEmail        = (EditText) findViewById(R.id.edtEmail);
        btnLogin        = (Button) findViewById(R.id.btnDangNhap);
        btnSignUp       = (Button) findViewById(R.id.btnDangKi);
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setContentView(R.layout.activity_owner);
                referenceLoginActivity();
            }
        });
    }

}
