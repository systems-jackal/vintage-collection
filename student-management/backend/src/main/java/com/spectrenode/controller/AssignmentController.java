package com.spectrenode.controller;

import com.spectrenode.dto.CreateAssignmentRequest;
import com.spectrenode.model.Assignment;
import com.spectrenode.model.Course;
import com.spectrenode.repository.AssignmentRepository;
import com.spectrenode.repository.CourseRepository;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/assignments")
public class AssignmentController {

    private final AssignmentRepository assignmentRepository;
    private final CourseRepository courseRepository;

    public AssignmentController(
            AssignmentRepository assignmentRepository,
            CourseRepository courseRepository) {

        this.assignmentRepository = assignmentRepository;
        this.courseRepository = courseRepository;
    }

    @PostMapping
    public Assignment createAssignment(
            @RequestBody CreateAssignmentRequest request) {

        Course course = courseRepository
                .findById(request.getCourseId())
                .orElseThrow();

        Assignment assignment = new Assignment();

        assignment.setTitle(request.getTitle());
        assignment.setDescription(request.getDescription());
        assignment.setDueDate(request.getDueDate());
        assignment.setCourse(course);

        return assignmentRepository.save(assignment);
    }

    @GetMapping
    public List<Assignment> getAllAssignments() {
        return assignmentRepository.findAll();
    }
}