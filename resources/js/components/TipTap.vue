<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

import { BulletList, ListItem, OrderedList } from "@tiptap/extension-list";

import {
    Bold,
    Italic,
    Strikethrough,
    Heading1,
    Heading2,
    Heading3,
    Heading4,
    Heading5,
    Heading6,
    ListOrdered,
    List,
    Underline,
    Pilcrow,
    Redo,
    Undo,
    Link,
} from "lucide-vue-next";

const editor = useEditor({
    content: "<p>I'm running Tiptap with Vue.js. 🎉</p>",
    extensions: [StarterKit],
    editorProps: {
        attributes: {
            class: "min-h-48 max-h-64 p-4 overflow-y-auto prose outline-none",
        },
    },
});

const setLink = () => {
    const previousUrl = this.editor.getAttributes('link').href
    const url = window.prompt('URL', previousUrl)

    // cancelled
    if (url === null) {
    return
    }

    // empty
    if (url === '') {
    this.editor.chain().focus().extendMarkRange('link').unsetLink().run()

    return
    }

    // update link
    this.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run()
}
</script>

<template>
    <div
        class="border border-gray-400 rounded-md overflow-hidden w-full max-w-5xl mx-auto bg-white"
    >
        <section
            class="flex items-center flex-wrap gap-x-3 p-2 border-b border-gray-400"
        >
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor?.can().chain().focus().toggleBold().run()"
                :class="{ 'bg-gray-300': editor?.isActive('bold') }"
            >
                <Bold size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor?.can().chain().focus().toggleItalic().run()"
                :class="{ 'bg-gray-300': editor?.isActive('italic') }"
            >
                <Italic size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().toggleStrike().run()"
                :disabled="!editor?.can().chain().focus().toggleStrike().run()"
                :class="{ 'bg-gray-300': editor?.isActive('strike') }"
            >
                <strikethrough size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().toggleUnderline().run()"
                :disabled="
                    !editor?.can().chain().focus().toggleUnderline().run()
                "
                :class="{ 'bg-gray-300': editor?.isActive('underline') }"
            >
                <underline size="18" />
            </button>
            <button
                @click="setLink"
                :class="{ 'bg-gray-300': editor?.isActive('link') }"
            >
                <Link size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().setParagraph().run()"
                :class="{ 'bg-gray-300': editor?.isActive('paragraph') }"
            >
                <pilcrow size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="
                    editor.chain().focus().toggleHeading({ level: 1 }).run()
                "
                :class="{
                    'bg-gray-300': editor?.isActive('heading', { level: 1 }),
                }"
            >
                <Heading1 size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="
                    editor.chain().focus().toggleHeading({ level: 2 }).run()
                "
                :class="{
                    'bg-gray-300': editor?.isActive('heading', { level: 2 }),
                }"
            >
                <heading2 size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="
                    editor.chain().focus().toggleHeading({ level: 3 }).run()
                "
                :class="{
                    'bg-gray-300': editor?.isActive('heading', { level: 3 }),
                }"
            >
                <heading3 size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="
                    editor.chain().focus().toggleHeading({ level: 4 }).run()
                "
                :class="{
                    'bg-gray-300': editor?.isActive('heading', { level: 4 }),
                }"
            >
                <heading4 size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="
                    editor.chain().focus().toggleHeading({ level: 5 }).run()
                "
                :class="{
                    'bg-gray-300': editor?.isActive('heading', { level: 5 }),
                }"
            >
                <heading5 size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="
                    editor.chain().focus().toggleHeading({ level: 6 }).run()
                "
                :class="{
                    'bg-gray-300': editor?.isActive('heading', { level: 6 }),
                }"
            >
                <heading6 size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'bg-gray-300': editor?.isActive('bulletList') }"
            >
                <list size="18" />
            </button>
            <button
                class="p-1 rounded-md"
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'bg-gray-300': editor?.isActive('orderedList') }"
            >
                <listOrdered size="18" />
            </button>
            <button
                class="p-1 rounded-md disabled:text-gray-400"
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor?.can().chain().focus().undo().run()"
            >
                <Undo size="18" />
            </button>
            <button
                class="p-1 rounded-md disabled:text-gray-400"
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor?.can().chain().focus().redo().run()"
            >
                <Redo size="18" />
            </button>
        </section>
        <editor-content :editor="editor" id="message" />
    </div>
</template>
