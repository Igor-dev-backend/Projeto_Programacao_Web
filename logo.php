<?php
// ============================================
// COMPONENTE DE LOGO MENUEXPRESS
// ============================================
// Este arquivo pode ser incluído em outras páginas usando: include 'logo.php';
// 
// Parâmetros opcionais via variáveis:
// $logo_size = 'normal' | 'compact' | 'small' (padrão: 'normal')
// $logo_class = 'classe-css-personalizada' (opcional)
?>

<a href="index.php" class="logo <?php echo $logo_class ?? ''; ?>" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
    <!-- Linhas de movimento -->
    <div style="position: relative; display: flex; align-items: center; height: 50px;">
        <span style="position: absolute; left: -18px; width: 12px; height: 3px; background: #FF5733; border-radius: 2px; top: 50%; transform: translateY(-50%);"></span>
        <span style="position: absolute; left: -28px; width: 10px; height: 3px; background: #FF5733; border-radius: 2px; top: 50%; transform: translateY(-50%);"></span>
        <span style="position: absolute; left: -36px; width: 8px; height: 3px; background: #FF5733; border-radius: 2px; top: 50%; transform: translateY(-50%);"></span>
        <!-- Círculo com ícone -->
        <div style="width: 50px; height: 50px; background: #FF5733; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(255, 87, 51, 0.3); position: relative; z-index: 1;">
            <i class="fas fa-utensils" style="color: white; font-size: 24px;"></i>
        </div>
    </div>
    <?php if (!isset($logo_size) || $logo_size !== 'compact'): ?>
    <!-- Texto do logo -->
    <div style="display: flex; flex-direction: row; align-items: baseline; line-height: 1;">
        <span style="font-family: 'Poppins', 'Montserrat', sans-serif; font-weight: 700; font-size: 1.8rem; color: #2C2C2C; letter-spacing: -0.5px;">Menu</span>
        <span style="font-family: 'Poppins', 'Montserrat', sans-serif; font-weight: 700; font-size: 1.8rem; color: #FF5733; letter-spacing: -0.5px; margin-left: 0;">Express</span>
    </div>
    <?php endif; ?>
</a>
