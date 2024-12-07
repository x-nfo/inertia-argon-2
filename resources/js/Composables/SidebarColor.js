import { ref, watch } from 'vue';


// Daftar warna dan pasangan gradient yang sesuai

const colorGradients = {
  blue: { from: 'blue-500', to: 'violet-500' },
  gray: { from: 'zinc-800', to: 'zinc-700' },
  cyan: { from: 'blue-700', to: 'cyan-500' },
  emerald: { from: 'emerald-500', to: 'teal-400' },
  orange: { from: 'orange-500', to: 'yellow-500' },
  red: { from: 'red-600', to: 'orange-600' },
};

const selectedColor = ref(localStorage.getItem('selectedColor') || 'bg-blue-500/13'); // Menyimpan warna terpilih

export function useSidebarColor ()
{
    // Fungsi untuk mengubah warna aktif
    function setActiveColor ( color )
    {
        selectedColor.value = `bg-${color}-500/30`;
    }

    // Watch perubahan dan simpan ke localStorage
    watch( selectedColor, ( newColor ) =>
    {
        localStorage.setItem( 'selectedColor', newColor );
    } );

    return {
        selectedColor,
        setActiveColor,
        colorGradients, // Mengembalikan objek gradient agar dapat diakses di komponen parent
    };
}