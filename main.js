import { initializeApp } from "firebase/app";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "firebase/auth";

// Konfigurasi Firebase kamu
const firebaseConfig = {
  apiKey: "AIzaSyBOZo6R-FAF3KdoC3Xw28F6RiWL4qfx7XY",
  authDomain: "webproject-5f104.firebaseapp.com",
  projectId: "webproject-5f104",
  storageBucket: "webproject-5f104.appspot.com",
  messagingSenderId: "300144113544",
  appId: "1:300144113544:web:f35663fbf07deec1496c3d",
  measurementId: "G-DERMQJFLM8",
};

// Inisialisasi Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

// Fungsi Login dan Register
export function register(email, password) {
  createUserWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
      console.log("Berhasil daftar:", userCredential.user);
    })
    .catch((error) => {
      console.error("Error saat daftar:", error.message);
    });
}

export function login(email, password) {
  signInWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
      console.log("Berhasil login:", userCredential.user);
    })
    .catch((error) => {
      console.error("Error saat login:", error.message);
    });
}