var notes = {

    markdownDecode: function () {

        var notesContentsElts = document.getElementsByClassName("note-content");

        for (let noteContentElt of notesContentsElts) {
            noteContentElt.innerHTML = marked(noteContentElt.textContent);
        }
    }
};