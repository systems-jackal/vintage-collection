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

![Last Commit](https://img.shields.io/github/last-commit/systems-jackal/vintage-collection?style=flat-square&logo=git&logoColor=white&color=E44C30)
![Commit Activity](https://img.shields.io/github/commit-activity/m/systems-jackal/vintage-collection?style=flat-square&logo=githubactions&logoColor=white&color=2088FF)
![Repo Size](https://img.shields.io/github/repo-size/systems-jackal/vintage-collection?style=flat-square&logo=files&logoColor=white&color=6DB33F)
![Top Language](https://img.shields.io/github/languages/top/systems-jackal/vintage-collection?style=flat-square&logo=openjdk&logoColor=white&color=ED8B00)
![Language Count](https://img.shields.io/github/languages/count/systems-jackal/vintage-collection?style=flat-square&color=blueviolet)
![Open Issues](https://img.shields.io/github/issues/systems-jackal/vintage-collection?style=flat-square&logo=github&color=red)
![License](https://img.shields.io/github/license/systems-jackal/vintage-collection?style=flat-square&color=3178C6)

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

| Property | Value |
|---|---|
| **Status** | 🟢 In Development |
| **Stack** | Java 17, Spring Boot, Spring Security, JPA, Maven |
| **Auth** | JWT-based authentication |
| **Roles** | Admin · Teacher · Student |

```bash
cd student-management/backend
./mvnw spring-boot:run
```

---

## `> cat architecture.txt`

```
vintage-collection/
│
├── student-management/
│   ├── backend/
│   │   ├── src/main/java/
│   │   │   ├── controller/     # REST Endpoints
│   │   │   ├── service/        # Business Logic
│   │   │   ├── repository/     # DB Access (JPA)
│   │   │   ├── model/          # Entities
│   │   │   └── config/         # Security & JWT
│   │   └── pom.xml
│   └── README.md
│
├── [next-project]/             # Coming soon
│
└── README.md                   ← you are here
```

---

## `> cat roadmap.md`

```
[x] Student Management System — backend core
[ ] Frontend (Vanilla JS or React)
[ ] Docker containerization
[ ] CI/CD pipeline (GitHub Actions)
[ ] Explore Rust for a microservice
```

---

<div align="center">

`// built in the open · learning by shipping`

</div>