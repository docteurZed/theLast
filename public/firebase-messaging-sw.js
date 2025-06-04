importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyAbv6K8xUZaaaPzoe3B0jezJJBQJshumbg",
    authDomain: "thelast-78c11.firebaseapp.com",
    projectId: "thelast-78c11",
    storageBucket: "thelast-78c11.firebasestorage.app",
    messagingSenderId: "1035734482610",
    appId: "1:1035734482610:web:29298cff5a0f69b91353ab",
    measurementId: "G-60F96PFSE9"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('[firebase-messaging-sw.js] Message reçu en arrière-plan :', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: 'icons/icon-192x192.png'
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
