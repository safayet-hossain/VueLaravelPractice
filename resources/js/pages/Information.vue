<template>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Student List</h3>

       <router-link to="/create" class="btn btn-success">Add a new student</router-link>
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th col="5">Student Name:</th>
                    <th col="2">Student ID:</th>
                    <th col="2">Class:</th>
                    <th col="2">Actions:</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(student, index) in students" :key="student.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ student.name }}</td>
                    <td>{{ student.student_id }}</td>
                    <td>{{ student.class }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button @click="editStudent(student)" class="btn btn-primary btn-sm">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <button
                            @click="deleteStudent(student.id)"
                            class="btn btn-danger btn-sm mx-1"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- No students found< -->
        <div v-if="!loading && students.length === 0" class="text-center">
            <p>No students found</p>
        </div>

        <!-- Edit Form -->
        <div v-if="editing" class="mt-4">
            <h4>Edit Student</h4>
            <form @submit.prevent="updateStudent">
                <div class="mb-3">
                    <label for="name" class="form-label">Student Name</label>
                    <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        id="name"
                        placeholder="Enter name"
                    />
                </div>
                <div class="mb-3">
                    <label for="student_id" class="form-label">Student ID</label>
                    <input
                        type="text"
                        v-model="form.student_id"
                        class="form-control"
                        id="student_id"
                        placeholder="Enter ID"
                    />
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label">Class</label>
                    <input
                        type="text"
                        v-model="form.class"
                        class="form-control"
                        id="class"
                        placeholder="Enter class"
                    />
                </div>
                <button type="submit" class="btn btn-success">Update Student</button>
                <button @click="cancelEdit" type="button" class="btn btn-secondary mx-2">
                    Cancel
                </button>
            </form>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            students: [], // List of students
            form: {
                name: "",
                student_id: "",
                class: "",
            },
            editing: false, // Whether we are editing
            currentId: null, // The ID of the student being edited
            loading: true, // Loading state
        };
    },
    mounted() {
        this.fetchStudents();
    },
    methods: {
        // Fetch all students
        async fetchStudents() {
            try {
                const response = await axios.get("/api/students");
                this.students = response.data;
            } catch (error) {
                console.error("Error fetching students:", error);
            } finally {
                this.loading = false;
            }
        },

        // Edit a student
        editStudent(student) {
            this.form = { ...student };
            this.editing = true;
            this.currentId = student.id;
        },

        // Update a student
        async updateStudent() {
            try {
                await axios.put(`/api/students/${this.currentId}`, this.form);
                alert("Student updated successfully!");
                this.fetchStudents(); // Refresh the list
                this.cancelEdit();
            } catch (error) {
                console.error("Error updating student:", error);
                alert("Failed to update student.");
            }
        },

        // Cancel editing
        cancelEdit() {
            this.form = {
                name: "",
                student_id: "",
                class: "",
            };
            this.editing = false;
            this.currentId = null;
        },

        // Delete a student
        async deleteStudent(id) {
            if (confirm("Are you sure you want to delete this student?")) {
                try {
                    await axios.delete(`/api/students/${id}`);
                    alert("Student deleted successfully!");
                    this.fetchStudents(); // Refresh the list
                } catch (error) {
                    console.error("Error deleting student:", error);
                    alert("Failed to delete student.");
                }
            }
        },
    },
};
</script>
