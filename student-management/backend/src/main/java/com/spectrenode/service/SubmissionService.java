package com.spectrenode.service;

import com.spectrenode.dto.CreateSubmissionRequest;
import com.spectrenode.model.Assignment;
import com.spectrenode.model.Submission;
import com.spectrenode.model.User;
import com.spectrenode.repository.AssignmentRepository;
import com.spectrenode.repository.SubmissionRepository;
import com.spectrenode.repository.UserRepository;
import org.springframework.stereotype.Service;

@Service
public class SubmissionService {

    private final SubmissionRepository submissionRepository;
    private final UserRepository userRepository;
    private final AssignmentRepository assignmentRepository;

    public SubmissionService(
            SubmissionRepository submissionRepository,
            UserRepository userRepository,
            AssignmentRepository assignmentRepository) {

        this.submissionRepository = submissionRepository;
        this.userRepository = userRepository;
        this.assignmentRepository = assignmentRepository;
    }

    public Submission submit(
            CreateSubmissionRequest request) {

        User student = userRepository
                .findById(request.getStudentId())
                .orElseThrow();

        Assignment assignment = assignmentRepository
                .findById(request.getAssignmentId())
                .orElseThrow();

        Submission submission = new Submission();

        submission.setStudent(student);
        submission.setAssignment(assignment);
        submission.setSubmissionText(
                request.getSubmissionText());

        return submissionRepository.save(submission);
    }
}