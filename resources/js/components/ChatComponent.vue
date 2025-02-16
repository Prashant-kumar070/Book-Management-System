<template>
    <div>
      <h2>Chat</h2>
      <div v-for="msg in messages" :key="msg.id">
        <strong>{{ msg.user.name }}:</strong> {{ msg.message }}
      </div>
      <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message" />
    </div>
  </template>
  
  <script>
  import * as Ably from "ably";
  
  export default {
    data() {
      return {
        messages: [],
        newMessage: "",
        chatId: 1, // Change dynamically
      };
    },
    async created() {
      this.fetchMessages();
      const client = new Ably.Realtime("your-ably-api-key");
      const channel = client.channels.get("chat." + this.chatId);
  
      channel.subscribe("MessageSent", (message) => {
        this.messages.push(message.data);
      });
    },
    methods: {
      async fetchMessages() {
        const res = await fetch(`/api/messages/${this.chatId}`);
        this.messages = await res.json();
      },
      async sendMessage() {
        if (!this.newMessage) return;
  
        const res = await fetch("/api/send-message", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
          body: JSON.stringify({
            chat_id: this.chatId,
            message: this.newMessage,
          }),
        });
  
        const data = await res.json();
        this.messages.push(data.message);
        this.newMessage = "";
      },
    },
  };
  </script>
  