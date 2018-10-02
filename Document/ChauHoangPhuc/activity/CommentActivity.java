package com.study.android.foodmap;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ListView;

public class CommentActivity extends AppCompatActivity {

    private ListView listComments;
    private ImageButton btnSend;
    private EditText edtComment;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_comment);
        getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_ADJUST_PAN);
        references();
    }


    private void references(){
        listComments    = (ListView)findViewById(R.id.listComments);
        btnSend         = (ImageButton)findViewById(R.id.btnSend);
        edtComment      = (EditText)findViewById(R.id.edtComment);
    }
}
