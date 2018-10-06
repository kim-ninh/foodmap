package com.hcmus.dreamers.foodmap.Model;

import java.sql.Date;

public class Comment {
    private Date mDateComment;
    private String mComment;
    private String mNameUser; // tên người comment
    
    public Comment() { }

    public Comment(Date dateComment, String comment, String nameUser) {
        this.mDateComment = dateComment;
        this.mComment = comment;
        this.mNameUser = nameUser;
    }

    public Date getDateComment() {
        return mDateComment;
    }

    public void setDateComment(Date dateComment) {
        this.mDateComment = dateComment;
    }

    public String getComment() {
        return mComment;
    }

    public void setComment(String comment) {
        this.mComment = comment;
    }

    public String getNameUser() {
        return mNameUser;
    }

    public void setNameUser(String nameUser) {
        this.mNameUser = nameUser;
    }
}
