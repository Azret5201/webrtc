const localVideo = document.querySelector('#localVideo');


navigator.mediaDevices.getUserMedia({video: true, audio: true}).then(function(mediaStream) {
    stream = mediaStream;
    localVideo.srcObject = stream;

    localVideo.onloadedmetadata = function (e) {
        localVideo.play();
    };
});
