"use strict";

function strartTwitter() {
    var configProfile = {
        "profile": {
            "screenName": 'multifourdesign'
        },
    "domId": 'footer-twitter-img-twitterfeed',
        "maxTweets": 1,
        "enableLinks": true,
        "showUser": false,
        "showTime": true,
        "showImages": false,
        "showRetweet": false,
        "showInteraction": false
    };
    twitterFetcher.fetch(configProfile);
}


window.addEventListener('load', function() {

if (window.twitterFetcher) {
    strartTwitter();
}

document.addEventListener('cookie.accepted', function () {
    strartTwitter();
});

});
