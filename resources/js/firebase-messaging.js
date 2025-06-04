import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// Ton config Firebase
const firebaseConfig = {
    apiKey: "AIzaSyAbv6K8xUZaaaPzoe3B0jezJJBQJshumbg",
    authDomain: "thelast-78c11.firebaseapp.com",
    projectId: "thelast-78c11",
    storageBucket: "thelast-78c11.firebasestorage.app",
    messagingSenderId: "1035734482610",
    appId: "1:1035734482610:web:29298cff5a0f69b91353ab",
    measurementId: "G-60F96PFSE9"
};

// Initialisation Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// Demande permission + récupère le token
export function initFirebaseMessagingRegistration() {
    if ('Notification' in window && 'serviceWorker' in navigator) {
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                getToken(messaging, {
                    vapidKey: "vFHySPXVO9vrNGaJpcB7TEpJnG1sChq7rvZ27yy2OqA"
                }).then(currentToken => {
                    if (currentToken) {
                        // Envoi du token au serveur
                        fetch('/store-fcm-token', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ token: currentToken })
                        });
                    } else {
                        console.warn('Aucun token disponible.');
                    }
                }).catch(err => {
                    console.error('Erreur de récupération du token :', err);
                });
            }
        });
    }
}

// Réception des messages foreground
onMessage(messaging, payload => {
    console.log('Message reçu : ', payload);
    alert(payload.notification.title + "\n" + payload.notification.body);
});
