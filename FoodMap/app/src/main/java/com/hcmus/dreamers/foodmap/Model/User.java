package com.hcmus.dreamers.foodmap.Model;

public class User {
    protected String mName;
    protected String mEmail;

    public User(String name, String email) {
        this.mName = name;
        this.mEmail = email;
    }

    public String getName() {
        return mName;
    }

    public void setName(String name) {
        this.mName = name;
    }

    public String getEmail() {
        return mEmail;
    }

    public void setEmail(String email) {
        this.mEmail = email;
    }
}
