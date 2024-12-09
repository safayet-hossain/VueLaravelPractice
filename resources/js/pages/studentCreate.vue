<template>
  <div class="container mt-5">
      <h3 class="text-center mb-4">Student Information</h3>

      <form @submit.prevent="submitForm">
          <div class="mb-3">
              <label for="name" class="form-label">Student Name</label>
              <input type="text" v-model="form.name" class="form-control" id="name" placeholder="Enter name">
          </div>
          <div class="mb-3">
              <label for="student_id" class="form-label">Student ID</label>
              <input type="text" v-model="form.student_id" class="form-control" id="student_id" placeholder="Enter ID">
          </div>
          <div class="mb-3">
              <label for="class" class="form-label">Class</label>
              <input type="text" v-model="form.class" class="form-control" id="class" placeholder="Enter class">
          </div>
          <button type="submit" class="btn btn-success">{{ editing ? "Update" : "Add" }} Student</button>
      </form>

      <!-- Student Table -->
      <table class="table table-bordered table-hover mt-4">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Student Name</th>
                  <th>Student ID</th>
                  <th>Class</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="(student, index) in students" :key="student.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ student.name }}</td>
                  <td>{{ student.student_id }}</td>
                  <td>{{ student.class }}</td>
                  <td>
                      <button @click="editStudent(student)" class="btn btn-primary btn-sm">Edit</button>
                      <button @click="deleteStudent(student.id)" class="btn btn-danger btn-sm mx-1">Delete</button>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
      return {
          students: [],
          form: {
              name: '',
              student_id: '',
              class: ''
          },
          editing: false,
          currentId: null
      };
  },
  mounted() {
      this.fetchStudents();
  },
  methods: {
      async fetchStudents() {
          const response = await axios.get('/api/students');
          
          
          this.students = response.data;
          console.log('asi',this.students);
      },
      async submitForm() {
          if (this.editing) {
              await axios.put(`/api/students/${this.currentId}`, this.form);
          } else {
              await axios.post('/api/students', this.form);
          }
          this.resetForm();
          this.fetchStudents();
      },
      editStudent(student) {
          this.form = { ...student };
          this.editing = true;
          this.currentId = student.id;
      },
      async deleteStudent(id) {
          await axios.delete(`/api/students/${id}`);
          this.fetchStudents();
      },
      resetForm() {
          this.form = {
              name: '',
              student_id: '',
              class: ''
          };
          this.editing = false;
          this.currentId = null;
      }
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
</style>
