package com.hcmus.dreamers.foodmap.Model;

import com.google.android.gms.maps.model.LatLng;

import java.sql.Time;
import java.util.ArrayList;
import java.util.List;

public class Restaurant {
    private int mId;
    private String mName;
    private String mAddress;
    private String mPhoneNumber;
    private String mDescribe;
    private String mUrlImage;
    private Time mTimeOpen;
    private Time mTimeClose;
    private LatLng mLocation;
    private int mRank;
    private String[] mTags;

    private List<Dish> mDishs;
    private List<Comment> mComments;


    public Restaurant() {
        mDishs = null;
        mComments = null;
    }

    public Restaurant(int id, String name, String address, String phoneNumber,
                      String describe, String urlImage, Time timeOpen, Time timeClose, int rank, String[] tags, LatLng location) {
        this.mId = id;
        this.mName = name;
        this.mAddress = address;
        this.mPhoneNumber = phoneNumber;
        this.mDescribe = describe;
        this.mUrlImage = urlImage;
        this.mTimeOpen = timeOpen;
        this.mTimeClose = timeClose;
        this.mRank = rank;
        this.mLocation = location;
        this.mTags = tags;
        mDishs = null;
        mComments = null;
    }

    public Restaurant(int id, String name, String address, String phoneNumber,
                      String describe, String urlImage, Time timeOpen, Time timeClose, int rank, String[] tags) {
        this.mId = id;
        this.mName = name;
        this.mAddress = address;
        this.mPhoneNumber = phoneNumber;
        this.mDescribe = describe;
        this.mUrlImage = urlImage;
        this.mTimeOpen = timeOpen;
        this.mTimeClose = timeClose;
        this.mRank = rank;
        this.mTags = tags;
        mDishs = null;
        mComments = null;
    }

    public int getId() {
        return mId;
    }

    public String getName() {
        return mName;
    }

    public void setName(String name) {
        this.mName = name;
    }

    public String getAddress() {
        return mAddress;
    }

    public void setAddress(String address) {
        this.mAddress = address;
    }

    public String getPhoneNumber() {
        return mPhoneNumber;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.mPhoneNumber = phoneNumber;
    }

    public String getDescribe() {
        return mDescribe;
    }

    public void setDescribe(String describe) {
        this.mDescribe = describe;
    }

    public String getUrlImage() {
        return mUrlImage;
    }

    public void setUrlImage(String urlImage) {
        this.mUrlImage = urlImage;
    }

    public Time getTimeOpen() {
        return mTimeOpen;
    }

    public void setTimeOpen(Time timeOpen) {
        this.mTimeOpen = timeOpen;
    }

    public Time getTimeClose() {
        return mTimeClose;
    }

    public void setTimeClose(Time timeClose) {
        this.mTimeClose = timeClose;
    }

    public int getRank(){
        return this.mRank;
    }

    public void setRank(int rank){
        this.mRank = rank;
    }

    public LatLng getLocation() {
        return mLocation;
    }

    public void setLocation(LatLng location) {
        this.mLocation = location;
    }

    public void addDish(Dish dish){
        if (mDishs == null)
            mDishs = new ArrayList<Dish>();

        mDishs.add(dish);
    }

    public void deleteDish(int position){
        mDishs.remove(position);
    }

    public void deleteDish(Dish dish){
        mDishs.remove(dish);
    }

    public List<Dish> getDishs(){
        return mDishs;
    }

    public void setDishs(List<Dish> dishs){
        mDishs = dishs;
    }

    public void addComment(Comment comment){
        if (mComments == null)
            mComments = new ArrayList<>();
        mComments.add(comment);
    }

    public List<Comment> getComments(){
        return mComments;
    }

    public void setComments(List<Comment> comments){
        mComments = comments;
    }

    public void setTags(String[] tags){
        this.mTags = tags;
    }

    public String[] getTags(){
        return this.mTags;
    }
}
