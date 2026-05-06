const { createApp, ref, onMounted } = Vue;

createApp({
    setup() {
        const records = ref([]);
        const loading = ref(true);

        const loadRecords = async () => {
            try {
                const response = await fetch('../../controllers/api_supplies.php');
                if (!response.ok) throw new Error("Error al obtener datos");
                records.value = await response.json();
            } catch (error) {
                console.error(error);
            } finally {
                loading.value = false;
            }
        };

        onMounted(loadRecords);

        const updateRecord = async (item) => {
            const id = item._id?.$oid || item._id;
            try {
                const response = await fetch('../../controllers/api_supplies.php', {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ ...item, id })
                });
                const result = await response.json();
                if (result.success) {
                    item.isEditing = false;
                    loadRecords();
                }
            } catch (error) {
                alert("Error al actualizar registro");
            }
        };

        const deleteRecord = async (item) => {
            if (confirm("¿Eliminar " + item.name + "?")) {
                const id = item._id?.$oid || item._id;
                try {
                    const response = await fetch('../../controllers/api_supplies.php', {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id })
                    });
                    const result = await response.json();
                    if (result.success) loadRecords();
                } catch (error) {
                    alert("Error al eliminar registro");
                }
            }
        };

        return { records, loading, updateRecord, deleteRecord };
    }
}).mount('#app');