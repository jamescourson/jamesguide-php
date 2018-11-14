class User {
    update() {
        $.ajax({
            method: "POST",
            data: {
                email: this.email,
                pic: this.pic,
                title: this.title,
                updated: new Date.getTime(),
                url: "assets/scripts/editProfile.php"
            },
            dataType: "json",
        });
    };
};