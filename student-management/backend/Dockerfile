FROM maven:3.9-eclipse-temurin-21

WORKDIR /app

COPY student-management/backend ./backend

WORKDIR /app/backend

RUN mvn clean package -DskipTests

CMD ["java", "-jar", "target/backend-0.0.1-SNAPSHOT.jar"]