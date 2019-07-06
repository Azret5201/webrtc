var video = document.getElementById(sourcevid);

navigator.getUserMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({ audio: true, video: true },
        function(s) {
        stream = s;
            var video = document.querySelector('video');
            video.srcObject = stream;
            video.onloadedmetadata = function(e) {
                video.play();
            };
        },
        function(err) {
            console.log("The following error occurred: " + err.name);
        }
    );
} else {
    console.log("getUserMedia not supported");
}
btnGetAudioTracks.addEventListener("click", function(){
    console.log("getAudioTracks");
    console.log(stream.getAudioTracks());
});

btnGetTrackById.addEventListener("click", function(){
    console.log("getTrackById");
    console.log(stream.getTrackById(stream.getAudioTracks()[0].id));
});

btnGetTracks.addEventListener("click", function(){
    console.log("getTracks()");
    console.log(stream.getTracks());
});

btnGetVideoTracks.addEventListener("click", function(){
    console.log("getVideoTracks()");
    console.log(stream.getVideoTracks());
});

btnRemoveAudioTrack.addEventListener("click", function(){
    console.log("removeAudioTrack()");
    stream.removeTrack(stream.getAudioTracks()[0]);
});

btnRemoveVideoTrack.addEventListener("click", function(){
    console.log("removeVideoTrack()");
    stream.removeTrack(stream.getVideoTracks()[0]);
});
