const loginForm =
    document.getElementById("loginForm");

loginForm.addEventListener(
    "submit",
    async (e) => {

        e.preventDefault();

        const email =
            document.getElementById("email").value;

        const password =
            document.getElementById("password").value;

        try {

            const response =
                await fetch(
                    `${API_BASE_URL}/api/auth/login`,
                    {
                        method:"POST",
                        headers:{
                            "Content-Type":
                                "application/json"
                        },
                        body:JSON.stringify({
                            email,
                            password
                        })
                    }
                );

            const data =
                await response.json();

            if(data.token){

                localStorage.setItem(
                    "token",
                    data.token
                );

                window.location.href =
                    "dashboard.html";

            }else{

                document.getElementById(
                    "message"
                ).innerText =
                    "Login failed";
            }

        } catch(error){

            document.getElementById(
                "message"
            ).innerText =
                "Server error";
        }
    }
);