console.log("Vue ok", Vue);

const endpoint = "http://localhost/boolean/php-todo-list-json/api/tasks/";

const { createApp } = Vue;

const app = createApp({
  name: "PHP ToDo List JSON",
  data: () => ({
    tasks: [],
    newTask: "",
  }),
  methods: {
    addTask() {
      const data = { task: this.newTask };

      const config = { headers: { "Content-Type": "multipart/form-data" } };

      axios.post(endpoint, data, config).then((res) => {
        this.tasks = res.data;
        this.newTask = "";
      });
    },
  },
  created() {
    axios.get(endpoint).then((res) => {
      this.tasks = res.data;
    });
  },
});

app.mount("#root");
