package com.hcmus.dreamers.foodmap.Model;

public class AdminRestaurant extends User {
    private String mUsername;
    private String mPassword;
    private String mPhoneNumber;

    public AdminRestaurant(String name, String email, String username, String password, String phoneNumber) {
        super(name, email);
        this.mUsername = username;
        this.mPassword = password;
        this.mPhoneNumber = phoneNumber;
    }

    public AdminRestaurant(String name, String email) {
        super(name, email);
    }

    public String getUsername() {
        return mUsername;
    }

    public void setUsername(String username) {
        this.mUsername = username;
    }

    public String getPassword() {
        return mPassword;
    }

    public void setPassword(String password) {
        this.mPassword = password;
    }

    public String getPhoneNumber() {
        return mPhoneNumber;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.mPhoneNumber = phoneNumber;
    }
}
