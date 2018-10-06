package com.hcmus.phuoc.foodmap;

public class Dish {
    private String Name;
    private String Price;

    public Dish(String Name, String Price){
        this.Name = Name;
        this.Price = Price;
    }

    public String getName() {
        return Name;
    }

    public String getPrice() {
        return Price;
    }

    public void setName(String name) {
        Name = name;
    }

    public void setPrice(String price){
        Price = price;
    }
}
