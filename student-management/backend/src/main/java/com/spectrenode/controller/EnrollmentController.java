package com.spectrenode.controller;

import com.spectrenode.dto.EnrollmentRequest;
import com.spectrenode.model.Course;
import com.spectrenode.model.Enrollment;
import com.spectrenode.model.User;
import com.spectrenode.repository.CourseRepository;
import com.spectrenode.repository.EnrollmentRepository;
import com.spectrenode.repository.UserRepository;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/enrollments")
public class EnrollmentController {

    private final EnrollmentRepository enrollmentRepository;
    private final UserRepository userRepository;
    private final CourseRepository courseRepository;

    public EnrollmentController(
            EnrollmentRepository enrollmentRepository,
            UserRepository userRepository,
            CourseRepository courseRepository) {

        this.enrollmentRepository = enrollmentRepository;
        this.userRepository = userRepository;
        this.courseRepository = courseRepository;
    }

    @PostMapping
    public Enrollment enrollStudent(
            @RequestBody EnrollmentRequest request) {

        User student = userRepository
                .findById(request.getStudentId())
                .orElseThrow();

        Course course = courseRepository
                .findById(request.getCourseId())
                .orElseThrow();

        Enrollment enrollment = new Enrollment();

        enrollment.setStudent(student);
        enrollment.setCourse(course);

        return enrollmentRepository.save(enrollment);
    }

    @GetMapping
    public List<Enrollment> getAllEnrollments() {
        return enrollmentRepository.findAll();
    }
}