package com.spectrenode.controller;

import com.spectrenode.dto.CreateSubmissionRequest;
import com.spectrenode.model.Submission;
import com.spectrenode.service.SubmissionService;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/submissions")
public class SubmissionController {

    private final SubmissionService submissionService;

    public SubmissionController(
            SubmissionService submissionService) {

        this.submissionService = submissionService;
    }

    @PostMapping
    public Submission submit(
            @RequestBody CreateSubmissionRequest request) {

        return submissionService.submit(request);
    }
    
}