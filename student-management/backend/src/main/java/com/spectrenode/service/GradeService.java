package com.spectrenode.service;

import com.spectrenode.dto.CreateGradeRequest;
import com.spectrenode.model.Grade;
import com.spectrenode.model.Submission;
import com.spectrenode.repository.GradeRepository;
import com.spectrenode.repository.SubmissionRepository;
import org.springframework.stereotype.Service;

@Service
public class GradeService {

    private final GradeRepository gradeRepository;
    private final SubmissionRepository submissionRepository;

    public GradeService(
            GradeRepository gradeRepository,
            SubmissionRepository submissionRepository) {

        this.gradeRepository = gradeRepository;
        this.submissionRepository = submissionRepository;
    }

    public Grade gradeSubmission(
            CreateGradeRequest request) {

        Submission submission = submissionRepository
                .findById(request.getSubmissionId())
                .orElseThrow();

        Grade grade = new Grade();

        grade.setSubmission(submission);
        grade.setScore(request.getScore());
        grade.setFeedback(request.getFeedback());

        return gradeRepository.save(grade);
    }
}