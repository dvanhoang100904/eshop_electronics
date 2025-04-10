// Toggle password visibility
document.querySelectorAll(".toggle-password").forEach((button) => {
    button.addEventListener("click", function () {
        const passwordInput = this.parentElement.querySelector("input");
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
});
