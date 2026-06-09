<div align="center">

```
██╗   ██╗██╗███╗   ██╗████████╗ █████╗  ██████╗ ███████╗
██║   ██║██║████╗  ██║╚══██╔══╝██╔══██╗██╔════╝ ██╔════╝
██║   ██║██║██╔██╗ ██║   ██║   ███████║██║  ███╗█████╗
╚██╗ ██╔╝██║██║╚██╗██║   ██║   ██╔══██║██║   ██║██╔══╝
 ╚████╔╝ ██║██║ ╚████║   ██║   ██║  ██║╚██████╔╝███████╗
  ╚═══╝  ╚═╝╚═╝  ╚═══╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝ ╚══════╝

 ██████╗ ██████╗ ██╗     ██╗     ███████╗ ██████╗████████╗██╗ ██████╗ ███╗   ██╗
██╔════╝██╔═══██╗██║     ██║     ██╔════╝██╔════╝╚══██╔══╝██║██╔═══██╗████╗  ██║
██║     ██║   ██║██║     ██║     █████╗  ██║        ██║   ██║██║   ██║██╔██╗ ██║
██║     ██║   ██║██║     ██║     ██╔══╝  ██║        ██║   ██║██║   ██║██║╚██╗██║
╚██████╗╚██████╔╝███████╗███████╗███████╗╚██████╗   ██║   ██║╚██████╔╝██║ ╚████║
 ╚═════╝ ╚═════╝ ╚══════╝╚══════╝╚══════╝ ╚═════╝   ╚═╝   ╚═╝ ╚═════╝ ╚═╝  ╚═══╝
```

*A personal monorepo — where backend experiments become production-grade applications.*

---

![Java](https://img.shields.io/badge/Java-17+-ED8B00?style=flat-square&logo=openjdk&logoColor=white)
![Spring Boot](https://img.shields.io/badge/Spring_Boot-3.x-6DB33F?style=flat-square&logo=springboot&logoColor=white)
![Maven](https://img.shields.io/badge/Maven-C71A36?style=flat-square&logo=apachemaven&logoColor=white)
![Rust](https://img.shields.io/badge/Rust-coming_soon-000000?style=flat-square&logo=rust&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-3178C6?style=flat-square)
![Status](https://img.shields.io/badge/Status-Active-00C851?style=flat-square)

</div>

---

## `> whoami`

This is **[systems-jackal](https://github.com/systems-jackal)**'s engineering lab — one repo, multiple real-world projects.

The goal: build production-grade applications, not just tutorials.

```
Focus Areas
├── REST API architecture
├── Authentication & Authorization (JWT, Spring Security)
├── Database design & ORM (JPA / Hibernate)
├── Clean backend code structure
└── Rust (on the roadmap)
```

---

## `> ls projects/`

### 📂 `student-management/`

> A full-featured student management platform.

| Property | Value |
|---|---|
| **Status** | 🟢 In Development |
| **Stack** | Java 17, Spring Boot, Spring Security, JPA, Maven |
| **Auth** | JWT-based authentication |
| **Roles** | Admin · Teacher · Student |

**What's inside:**
- Role-based access control (RBAC)
- Full CRUD for students, courses, and grades
- REST API with proper status codes and error handling
- Layered architecture: Controller → Service → Repository

```bash
cd student-management/backend
./mvnw spring-boot:run
```

---

> More projects drop as they're built. Watch the repo. ⭐

---

## `> cat architecture.txt`

```
vintage-collection/
│
├── student-management/
│   ├── backend/                # Spring Boot App
│   │   ├── src/
│   │   │   └── main/java/
│   │   │       ├── controller/ # REST Endpoints
│   │   │       ├── service/    # Business Logic
│   │   │       ├── repository/ # DB Access (JPA)
│   │   │       ├── model/      # Entities
│   │   │       └── config/     # Security & JWT
│   │   └── pom.xml
│   └── README.md
│
├── [next-project]/             # Coming soon
│
└── README.md                   ← you are here
```

---

## `> git clone`

```bash
# Clone the full collection
git clone https://github.com/systems-jackal/vintage-collection.git

# Navigate to a project
cd vintage-collection/student-management/backend

# Fire it up
./mvnw spring-boot:run
```

---

## `> cat roadmap.md`

```
[x] Student Management System — backend core
[ ] Add frontend (Vanilla JS or React)
[ ] Role-based dashboards
[ ] Docker containerization
[ ] CI/CD pipeline (GitHub Actions)
[ ] Explore Rust for a microservice
[ ] Second project TBD
```

---

## `> cat contributing.md`

This is a personal learning repo — but clean PRs and issues are welcome.

```bash
git checkout -b feature/your-idea
git commit -m "feat: short description"
git push origin feature/your-idea
```

---

<div align="center">

`// built in the open · learning by shipping`

![MIT License](https://img.shields.io/badge/License-MIT-3178C6?style=flat-square)

</div>