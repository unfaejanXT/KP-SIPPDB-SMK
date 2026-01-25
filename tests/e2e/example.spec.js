import { test, expect } from "@playwright/test";

test("homepage has title and main content", async ({ page }) => {
    await page.goto("/");

    // Expect a title "Beranda" or similar from layout
    // Line 3 of index.blade.php says @section('title', 'Beranda')
    // Usually this ends up in <title>, but let's check visible text.

    // Check for school name
    await expect(page.getByText("SMK Solusi Bangun Indonesia")).toBeVisible();

    // Check for "Penerimaan Peserta Didik Baru" or "Jadwal Pendaftaran"
    await expect(page.getByText("Jadwal Pendaftaran")).toBeVisible();
});

test("navigation to login page", async ({ page }) => {
    await page.goto("/");

    // Click on "Masuk Akun" link
    // Line 87: <a href="{{ route('login') }}" ... >Masuk Akun</a>
    await page.click("text=Masuk Akun");

    // Expect to be on login page
    await expect(page).toHaveURL(/.*login/);
    await expect(page.locator("form")).toBeVisible();
});
