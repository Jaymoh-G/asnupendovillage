function removeImage(imageId) {
    if (
        !confirm(
            "Are you sure you want to remove this image? This action cannot be undone."
        )
    ) {
        return;
    }

    // Show loading state
    const button = event.target.closest("button");
    const originalContent = button.innerHTML;
    button.innerHTML =
        '<svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
    button.disabled = true;

    fetch("/admin/remove-image", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            image_id: imageId,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Remove the image element from the DOM
                const imageContainer = button.closest(".group");
                imageContainer.style.opacity = "0";
                imageContainer.style.transform = "scale(0.8)";

                setTimeout(() => {
                    imageContainer.remove();

                    // Check if no images left
                    const remainingImages =
                        document.querySelectorAll(".group").length;
                    if (remainingImages === 0) {
                        const container = document.querySelector(".grid");
                        if (container) {
                            container.innerHTML =
                                '<div class="text-center py-4 text-gray-500">No images in this album yet.</div>';
                        }
                    }
                }, 300);

                // Show success message
                showNotification("Image removed successfully", "success");
            } else {
                throw new Error(data.message);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            showNotification(
                "Failed to remove image: " + error.message,
                "error"
            );

            // Restore button
            button.innerHTML = originalContent;
            button.disabled = false;
        });
}

function showNotification(message, type = "info") {
    // Create notification element
    const notification = document.createElement("div");
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === "success"
            ? "bg-green-500 text-white"
            : type === "error"
            ? "bg-red-500 text-white"
            : "bg-blue-500 text-white"
    }`;
    notification.textContent = message;

    // Add to page
    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove("translate-x-full");
    }, 100);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add("translate-x-full");
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
