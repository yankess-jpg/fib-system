<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFibSchema extends Migration
{
    public function up()
    {
        // ========================================
        // Citizens
        // ========================================
        $this->forge->addField([
            'citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'ssn' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('citizen_id', true);
        $this->forge->addKey('ssn');
        $this->forge->createTable('citizens');

        // ========================================
        // FIB Agents
        // ========================================
        $this->forge->addField([
            'agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unique' => true,
            ],
            'agent_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'agent_badge' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'rank' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'hire_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'active',
            ],
            'division' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'is_undercover' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'system_role' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'user',
            ],
            'password_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('agent_id', true);
        $this->forge->addForeignKey('citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('fib_agents');

        // ========================================
        // Investigations
        // ========================================
        $this->forge->addField([
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'case_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'lead_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'open',
            ],
            'priority' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'medium',
            ],
            'case_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'close_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('investigation_id', true);
        $this->forge->addForeignKey('lead_agent_id', 'fib_agents', 'agent_id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('investigations');

        // ========================================
        // Investigation Suspects
        // ========================================
        $this->forge->addField([
            'suspect_relation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'suspect_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'threat_level' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'notes' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'added_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('suspect_relation_id', true);
        $this->forge->addUniqueKey(['investigation_id', 'citizen_id']);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('investigation_suspects');

        // ========================================
        // Investigation Teams
        // ========================================
        $this->forge->addField([
            'team_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'assigned_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'assigned_by_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('team_id', true);
        $this->forge->addUniqueKey(['investigation_id', 'agent_id']);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('agent_id', 'fib_agents', 'agent_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('assigned_by_agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('investigation_teams');

        // ========================================
        // Evidence
        // ========================================
        $this->forge->addField([
            'evidence_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'evidence_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'evidence_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'chain_of_custody' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'location_stored' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'collected_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'collected_by_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'stored',
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('evidence_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('collected_by_agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('evidence');

        // ========================================
        // Surveillance Operations
        // ========================================
        $this->forge->addField([
            'operation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'target_citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'operation_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'authorization_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'start_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'authorized_by_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'location_coordinates' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'active',
            ],
            'notes' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('operation_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('target_citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('authorized_by_agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('surveillance_operations');

        // ========================================
        // Surveillance Logs
        // ========================================
        $this->forge->addField([
            'log_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'operation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'log_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'log_content' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'duration' => [
                'type' => 'INT',
                'null' => true,
            ],
            'participants' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'transcribed' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'analyst_notes' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('log_id', true);
        $this->forge->addForeignKey('operation_id', 'surveillance_operations', 'operation_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surveillance_logs');

        // ========================================
        // Search Warrants
        // ========================================
        $this->forge->addField([
            'warrant_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'target_citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'warrant_number' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'warrant_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'issued_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'expiration_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'issued_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'court_reference' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'target_location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'active',
            ],
            'execution_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'executed_by_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'findings' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('warrant_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('target_citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('executed_by_agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('search_warrants');

        // ========================================
        // Arrests
        // ========================================
        $this->forge->addField([
            'arrest_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'arrested_citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'arresting_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'arrest_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'charges' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'arrest_location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'arrest_notes' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'bail_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'arrested',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('arrest_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'SET NULL', 'SET NULL');
        $this->forge->addForeignKey('arrested_citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('arresting_agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('arrests');

        // ========================================
        // Interviews
        // ========================================
        $this->forge->addField([
            'interview_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'interviewed_citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'conducted_by_agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'interview_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'interview_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'duration' => [
                'type' => 'INT',
                'null' => true,
            ],
            'transcript' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'audio_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'relevance_score' => [
                'type' => 'INT',
                'null' => true,
            ],
            'outcome' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('interview_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('interviewed_citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->addForeignKey('conducted_by_agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('interviews');

        // ========================================
        // Financial Trails
        // ========================================
        $this->forge->addField([
            'trail_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'suspect_citizen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'transaction_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'null' => true,
            ],
            'transaction_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'from_account' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'to_account' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
            ],
            'suspicious_indicators' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'default' => 'under_review',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('trail_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('suspect_citizen_id', 'citizens', 'citizen_id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('financial_trails');

        // ========================================
        // Case Logs
        // ========================================
        $this->forge->addField([
            'log_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'log_entry' => [
                'type' => 'LONGTEXT',
            ],
            'log_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'log_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('log_id', true);
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('agent_id', 'fib_agents', 'agent_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('case_logs');

        // ========================================
        // Agent Notes
        // ========================================
        $this->forge->addField([
            'note_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'agent_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'investigation_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'note_content' => [
                'type' => 'LONGTEXT',
            ],
            'note_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('note_id', true);
        $this->forge->addForeignKey('agent_id', 'fib_agents', 'agent_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('investigation_id', 'investigations', 'investigation_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('agent_notes');

        // ========================================
        // Citizen Connections
        // ========================================
        $this->forge->addField([
            'connection_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'citizen_1_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'citizen_2_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'connection_type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'strength' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'description' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'identified_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('connection_id', true);
        $this->forge->addUniqueKey(['citizen_1_id', 'citizen_2_id']);
        $this->forge->addForeignKey('citizen_1_id', 'citizens', 'citizen_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('citizen_2_id', 'citizens', 'citizen_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('citizen_connections');
    }

    public function down()
    {
        $tables = [
            'citizen_connections',
            'agent_notes',
            'case_logs',
            'financial_trails',
            'interviews',
            'arrests',
            'search_warrants',
            'surveillance_logs',
            'surveillance_operations',
            'evidence',
            'investigation_teams',
            'investigation_suspects',
            'investigations',
            'fib_agents',
            'citizens',
        ];

        foreach ($tables as $table) {
            $this->forge->dropTable($table, true);
        }
    }
}