'use strict';

const mediaStremConstaints = {
    video: true,
};

const localVideo = document.querySelector('video');

let localStrem;

function gotLocalMediaStream(mediaStream) {
    localStrem = mediaStream;
    localVideo.srcObject = mediaStream;
}

function handleLocalMediaStreamError(error) {
    console.log('navigator.hetUserMedia error: ', error);
}

navigator.mediaDevices.getUserMedia(mediaStremConstaints)
    .then(gotLocalMediaStream).catch(handleLocalMediaStreamError);