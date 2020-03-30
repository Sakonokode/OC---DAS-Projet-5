import axios from "axios";

export default {
    login(login, password) {
        return axios.post("/api/security/login_check", {
            username: login,
            password: password
        });
    }
}