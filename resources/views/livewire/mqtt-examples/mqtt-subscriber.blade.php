<div>
    <div x-data="{ messages: [] }" 
         x-init="
            Echo.channel('mqtt-messages')
                .listen('MessageReceived', (event) => {
                    console.log('📥 Received:', event.message);
                    messages.push(event.message); // Push to the array
                });
         ">
        <template x-for="(msg, index) in messages" :key="index">
            <p class="text-green-700 my-1" x-text="msg"></p>
        </template>
    </div>
</div>
