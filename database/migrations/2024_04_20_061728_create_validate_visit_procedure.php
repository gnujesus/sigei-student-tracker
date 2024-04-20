<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
CREATE PROCEDURE validate_inserted_visit (
    IN p_id BIGINT UNSIGNED,
    IN p_first_name VARCHAR(255),
    IN p_last_name VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_arrival_time DATETIME,
    IN p_leaving_time DATETIME,
    IN p_career_id BIGINT UNSIGNED,
    IN p_building_id BIGINT UNSIGNED,
    IN p_classroom_id BIGINT UNSIGNED,
    IN p_visit_reason LONGTEXT
)
BEGIN
    DECLARE error_message VARCHAR(255);
    
    IF p_id IS NULL OR p_first_name IS NULL OR p_last_name IS NULL OR p_email IS NULL OR p_arrival_time IS NULL OR p_leaving_time IS NULL OR p_career_id IS NULL OR p_building_id IS NULL OR p_classroom_id IS NULL OR p_visit_reason IS NULL THEN
        SET error_message = 'All required fields must be provided';
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error_message;
    ELSE
        INSERT INTO visit (id, first_name, last_name, email, arrival_time, leaving_time, career_id, building_id, classroom_id, visit_reason, created_at, updated_at) 
        VALUES (p_id, p_first_name, p_last_name, p_email, p_arrival_time, p_leaving_time, p_career_id, p_building_id, p_classroom_id, p_visit_reason, NOW(), NOW());
    END IF;

END 
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP PROCEDURE IF EXISTS ValidateVisit");
    }
};
