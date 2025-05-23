export default function showTabs() {
    function showTab(tab) {
        const tabs = ["productos", "api"];

        tabs.forEach((t) => {
            document.getElementById(`tab-content-${t}`).classList.add("hidden");
            const tabBtn = document.getElementById(`tab-${t}`);
            tabBtn.classList.remove(
                "bg-green-100",
                "text-green-700",
                "shadow-inner"
            );
            tabBtn.classList.add("text-gray-600", "hover:bg-green-50");
        });

        document
            .getElementById(`tab-content-${tab}`)
            .classList.remove("hidden");
        const activeBtn = document.getElementById(`tab-${tab}`);
        activeBtn.classList.remove("text-gray-600", "hover:bg-green-50");
        activeBtn.classList.add(
            "bg-green-100",
            "text-green-700",
            "shadow-inner"
        );
    }

    document.addEventListener("DOMContentLoaded", () => {
        showTab("productos");
        document.getElementById("tab-productos").onclick = () =>
            showTab("productos");
        document.getElementById("tab-api").onclick = () => showTab("api");
    });
}
