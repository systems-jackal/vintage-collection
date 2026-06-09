const token =
    localStorage.getItem("token");

if(!token){
    window.location.href =
        "login.html";
}

async function loadDashboard(){

    const response =
        await fetch(
            `${API_BASE_URL}/api/dashboard`,
            {
                headers:{
                    Authorization:
                        `Bearer ${token}`
                }
            }
        );

    const data =
        await response.json();

    document.getElementById(
        "dashboardData"
    ).innerHTML = `
        <p>Total Courses:
            ${data.totalCourses}</p>

        <p>Total Assignments:
            ${data.totalAssignments}</p>

        <p>Total Announcements:
            ${data.totalAnnouncements}</p>

        <p>Total Enrollments:
            ${data.totalEnrollments}</p>
    `;
}

function logout(){

    localStorage.removeItem("token");

    window.location.href =
        "login.html";
}

loadDashboard();