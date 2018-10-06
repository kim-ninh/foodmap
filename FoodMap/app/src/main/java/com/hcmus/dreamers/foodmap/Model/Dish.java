package com.hcmus.dreamers.foodmap.Model;

public class Dish {
    private String mName;
    private String mPrice;
    private String mUrlImage;
    private int mCatalog;
    private String mTag;

    public Dish() {}

    public Dish(String name, String price, String urlImage, int catalog, String tag) {
        this.mName = name;
        this.mPrice = price;
        this.mUrlImage = urlImage;
        this.mCatalog = catalog;
        this.mTag = tag;
    }

    public String getName() {
        return mName;
    }

    public void setName(String name) {
        this.mName = name;
    }

    public String getPrice() {
        return mPrice;
    }

    public void setPrice(String price) {
        this.mPrice = price;
    }

    public String getUrlImage() {
        return mUrlImage;
    }

    public void setUrlImage(String urlImage) {
        this.mUrlImage = urlImage;
    }

    public int getCatalog() {
        return mCatalog;
    }

    public void setCatalog(int catalog) {
        this.mCatalog = catalog;
    }

    public String getTag(){
        return mTag;
    }

    public void setTag(String tag){
        this.mTag = tag;
    }

}
