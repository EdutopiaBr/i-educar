<?php

namespace iEducar\Support\Exceptions;

class Error
{
    const MISSING_STAGE_DEFAULT_ERROR = 1000;
    const MISSING_STAGE_TEACHER_ERROR = 1001;
    const MISSING_STAGE_COORDINATOR_ERROR = 1002;
    const SCORE_GREATER_THAN_MAX_ALLOWED = 1003;
    const SCORE_LESSER_THAN_MIN_ALLOWED = 1004;
    const EXAM_SCORE_GREATER_THAN_MAX_ALLOWED = 1005;
    const STUDENT_NOT_ENROLLED_IN_SCHOOL_CLASS = 1006;
    const EVALUATION_RULE_NOT_DEFINED_IN_LEVEL = 1007;
    const EVALUATION_RULE_NOT_ALLOW_GENERAL_ABSENCE = 1008;
}