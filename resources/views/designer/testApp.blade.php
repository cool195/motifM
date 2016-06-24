<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

<input type="button" onclick="follow()" value="follow">
</body>
<script src="/scripts/vendor.js"></script>
<script src="/scripts/JockeyJS.js"></script>
<script>
    var actionsShow = [{"icon": "", "name": "share"}]
    Jockey.send("action", {
        name: "showActions",
        token: "key",
        data: {"actions": actionsShow}
    });

    Jockey.on("action", function (action) {
        //login
        if (action.name == "authInfo") {
            var cookieData = [{
                "token": action.data.token,
                "pin": action.data.pin,
                "email": action.data.email,
                "name": action.data.name,
                "uuid": action.data.uuid
            }]
            alert(decodeURIComponent(action.data.name))
        }
    });

    //login send
    function follow() {
        Jockey.send("action", {
            name: "login",
            token: "key",
        });
    }
</script>
</html>
