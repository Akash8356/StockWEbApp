
















  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyA2OuEYOx7Oc19_n4e8mQoYU1E5ee3yo_Q",
    authDomain: "login-736dc.firebaseapp.com",
    projectId: "login-736dc",
    storageBucket: "login-736dc.appspot.com",
    messagingSenderId: "691819323065",
    appId: "1:691819323065:web:7f7f596e60eb9591144568"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);


// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);


const auth = firebase.auth();

function signup() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    const promise = auth.CreateUserWithEmailAndPassword(email.value,password.value);
    promise.catch(e=> alert(e.message));
    alert("signed in")


}




