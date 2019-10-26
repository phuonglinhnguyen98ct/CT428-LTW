let signup_form = document.getElementById("signup-form");

signup_form.onsubmit = () => {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let repassword = document.getElementById("re-password").value;

    let username_regex = /^[A-Za-z][A-Za-z\d]{8,15}$/g;
    let password_regex = /^(?=.*[A-Za-z])(?=.*[\d])([A-Za-z0-9]{6,15})$/g;
    let error = "";

    if (!username_regex.test(username)) {
        error += "+ Tên tài khoản có độ dài từ 6-15 ký tự, bao gồm chữ cái hoặc chữ số\n";
    }

    if (!password_regex.test(password)) {
        error += "+ Mật khẩu có độ dài từ 6-15 ký tự, bao gồm chữ cái và chữ số\n";
    }



    if (password !== repassword) {
        error += "+ Mật khẩu không trùng khớp";
    }

    if (error) {
        alert(error);
        return false;
    }
}