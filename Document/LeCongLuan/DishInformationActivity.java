package com.hcmus.phuoc.foodmap;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

public class DishInformationActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dish_information);

        Dish items[]={new Dish("chicken", "100k"), new Dish("duck", "200k"), new Dish("pig", "1 ty")};
        ListView dish_list = (ListView)findViewById(R.id.lstDish);

        //initialize Dish_information
        Dish_information_row Adapter = new Dish_information_row(this, R.layout.dish_layout, items);

        dish_list.setAdapter(Adapter);

        dish_list.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

            }
        });
    }


}
