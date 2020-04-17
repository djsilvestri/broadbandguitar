<template>
    <div>
        <div class="media my-3" v-for="reply in replies.data" :key="reply.id">
        
            <a class="mr-3" href="#">
                <img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200">
            </a>
            <div class="media-body">
               

        
            </div>
        </div>

        <div v-if="comment.repliesCount > 0" class="text-center">
            <button @click="fetchReplies" class="btn btn-info btn-sm">Load Replies</button>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar'
    export default {
        props: ['comment'],
        components: {
            Avatar
        },
        // data() {
        //     return {
        //         replies: {
        //             data: [],
        //             next_page_url: `/comments/${this.comment.id}/replies`
        //         }
        //     }
        // },
        data: () => ({
            replies: {
                data: []
            }
        }),
        methods: {
            fetchReplies() {
                const url = this.replies.next_page_url ? this.replies.next_page_url : `/comments/${this.comment.id}/replies`

                axios.get(url).then(({ data }) => {
                    this.replies = {
                        ...data,
                        data: [
                            ...this.replies.data,
                            ...data.data
                        ]
                    }
                })
            },
            addReply(reply) {
                this.replies = {
                    ...this.replies,
                    data: [
                        reply,
                        ...this.replies.data
                    ]
                }
            }
        }
    }
    // {{ $video->views }} {{ Str::plural('view', $video->views) }}
</script>