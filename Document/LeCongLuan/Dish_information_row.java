package com.hcmus.phuoc.foodmap;

import android.app.Activity;
import android.content.Context;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

public class Dish_information_row extends ArrayAdapter<Dish> {

    Context context;
    Dish items[];


    public Dish_information_row(@NonNull Context context, int resource, @NonNull  Dish[] items) {
        super(context, R.layout.dish_layout);
        this.context = context;
        this.items = items;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        LayoutInflater inflater = ((Activity) context).getLayoutInflater();
        View row = inflater.inflate(R.layout.dish_layout, null);

        TextView txtName = (TextView) row.findViewById(R.id.txtName);
        TextView txtPrice = (TextView) row.findViewById(R.id.txtPrice);

        //ImageView icon1 = (ImageView) row.findViewById(R.id.icon1);
        //ImageView icon2 = (ImageView) row.findViewById(R.id.icon2);

        txtName.setText(items[position].getName());
        txtPrice.setText(items[position].getPrice());
        //icon1.setImageResource(thumbnails[position]);
        //icon2.setImageResource(thumbnails[position]);

        return row;

    }

    @Override
    public int getCount() {
        return items.length;
    }

    @Nullable
    @Override
    public Dish getItem(int position) {
        return items[position];
    }

    @Override
    public long getItemId(int position) {
        return position;
    }
}
