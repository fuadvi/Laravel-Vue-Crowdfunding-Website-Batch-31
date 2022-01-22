export const UserComponent = {
    template: 
        `
          <div class="usersList">

            <ul>

                <li v-for="(user , index) in users" :key="index">

                    {{ user.name }} ||

                    <button @click="$emit('edit',index)">Edit</button>

                    <button @click="$emit('remove',index)">Delete</button>

                </li>

            </ul>

        </div>
    `,
    props: ['users']
} 