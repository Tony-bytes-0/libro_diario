<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\CuentasContable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        DB::table('roles')->updateOrInsert(
            ['nombre' => 'administrador'],
            ['descripcion' => 'Administrador'],
            ['created_at' => now()],
            ['updated_at' => now()],
        );

        DB::table('roles')->updateOrInsert(
            ['nombre' => 'gerencia'],
            ['descripcion' => 'Usuario con permisos para administrar, registrar, editar y eliminar'],
            ['created_at' => now()],
            ['updated_at' => now()],
        );

        DB::table('roles')->updateOrInsert(
            ['nombre' => 'analista'],
            ['descripcion' => 'Usuario analista, permisos basicos'],
            ['created_at' => now()],
            ['updated_at' => now()],
        );

        Cliente::create([
            'rif' => 'J501371962',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'AKERMED C.A.',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J312164336',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'AK GYM C.A.',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J299200581',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'LICOMARKET C.A.',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J300465535',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'ADMINISTAADORA SOL Y MAR, SRL',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J303762557',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'FABRICA DE TABACOS BERMUDEZ, CA',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'V16669340',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'SILVIA DEL VALLE MARCANO ROJAS',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'V32640669',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'ESTEFANI GONZALEZ',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'J500684789',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'RED POINT AUTO PARTS, CA',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'N/A',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'RESUMEN DIARIO DE VENTAS',
            'telefono' => '',
            'correo' => '',
        ]);
        Cliente::create([
            'rif' => 'N/A',
            'nombre' => '',
            'apellido' => '',
            'descripcion' => 'REPORTE GLOBAL DIARIO',
            'telefono' => '',
            'correo' => '',
        ]);

        // cuentas contables

        $cuentas = [
            ['codigo' => '1', 'descripcion' => 'ACTIVO'],
            ['codigo' => '11', 'descripcion' => 'CORRIENTE'],
            ['codigo' => '111', 'descripcion' => 'Efectivo y equivalentes'],
            ['codigo' => '001111', 'descripcion' => 'Caja Chica'],
            ['codigo' => '001112', 'descripcion' => 'Efectivo en Caja'],
            ['codigo' => '001113', 'descripcion' => 'Efectivo en Bancos Nacionales Bs.'],
            ['codigo' => '001113', 'descripcion' => 'Efectivo en Bancos Nacionales $'], // duplicado
            ['codigo' => '112', 'descripcion' => 'Otros activos financieros'],
            ['codigo' => '113', 'descripcion' => 'Cuentas por cobrar'],
            ['codigo' => '001131', 'descripcion' => 'Cuentas por Cobrar Comerciales'],
            ['codigo' => '001132', 'descripcion' => 'Cuentas por Cobrar Accionistas'],
            ['codigo' => '001133', 'descripcion' => 'Cuentas por Cobrar Trabajadores'],
            ['codigo' => '114', 'descripcion' => 'Activo por impuesto corriente'],
            ['codigo' => '001141', 'descripcion' => 'Crédito Fiscal IVA Compras'],
            ['codigo' => '001142', 'descripcion' => 'Retenciones de IVA Clientes'],
            ['codigo' => '001143', 'descripcion' => 'Excedente de Creditos Fiscales IVA'],
            ['codigo' => '001144', 'descripcion' => 'Retenciones No Descontadas de IVA'],
            ['codigo' => '001145', 'descripcion' => 'Declaración Estimada del ISLR'],
            ['codigo' => '001146', 'descripcion' => 'Anticipo de ISLR'],
            ['codigo' => '001147', 'descripcion' => 'ISLR retenido por clientes'],
            ['codigo' => '001148', 'descripcion' => 'ISLR retenido por Tarjetas de Crédito/Débito'],
            ['codigo' => '115', 'descripcion' => 'Inventarios'],
            ['codigo' => '001151', 'descripcion' => 'Mercancía Disponible para la Venta'],
            ['codigo' => '001152', 'descripcion' => 'Materia Prima Disponible'],
            ['codigo' => '001153', 'descripcion' => 'Producto Terminado Disponible'],
            ['codigo' => '001154', 'descripcion' => 'Producto en Proceso'],
            ['codigo' => '12', 'descripcion' => 'NO CORRIENTE'],
            ['codigo' => '121', 'descripcion' => 'Propiedades, planta y equipos'],
            ['codigo' => '001211', 'descripcion' => 'Edificaciones e Instalaciones'],
            ['codigo' => '001212', 'descripcion' => 'Mejoras a la Propiedad Arrendada'],
            ['codigo' => '001213', 'descripcion' => 'Muebles y Equipos de Oficina'],
            ['codigo' => '001214', 'descripcion' => 'Equipos de Computación'],
            ['codigo' => '001215', 'descripcion' => 'Equipos Eléctricos y Electrónicos'],
            ['codigo' => '001216', 'descripcion' => 'Dep. Acum. Edificaciones e Instalaciones'],
            ['codigo' => '001217', 'descripcion' => 'Dep. Acum. Mejoras a la Propiedad Arrendada'],
            ['codigo' => '001218', 'descripcion' => 'Dep. Acum. Muebles y Equipos de Oficina'],
            ['codigo' => '001219', 'descripcion' => 'Dep. Acum. Equipos de Computación'],
            ['codigo' => '001220', 'descripcion' => 'Dep. Acum. Equipos Eléctricos y Electrónicos'],
            ['codigo' => '122', 'descripcion' => 'Otros activos no corrientes'],
            ['codigo' => '001221', 'descripcion' => 'ISLR pagado en exceso'],
            ['codigo' => '2', 'descripcion' => 'PASIVO'],
            ['codigo' => '21', 'descripcion' => 'CORRIENTE'],
            ['codigo' => '211', 'descripcion' => 'Obligaciones bancarias'],
            ['codigo' => '002111', 'descripcion' => 'Prestamos Bancario por pagar'],
            ['codigo' => '002112', 'descripcion' => 'Efectos bancarios por pagar'],
            ['codigo' => '002113', 'descripcion' => 'Pagaré bancario por pagar'],
            ['codigo' => '212', 'descripcion' => 'Cuentas por pagar'],
            ['codigo' => '2121', 'descripcion' => 'Cuentas por pagar comerciales'],
            ['codigo' => '2122', 'descripcion' => 'Cuentas por pagar socios o directores'],
            ['codigo' => '2123', 'descripcion' => 'Cuentas por pagar empresas afiliadas'],
            ['codigo' => '2124', 'descripcion' => 'Dividendos por pagar'],
            ['codigo' => '213', 'descripcion' => 'Pasivos por tributos corrientes'],
            ['codigo' => '002131', 'descripcion' => 'Debito Fiscal IVA Ventas'],
            ['codigo' => '002132', 'descripcion' => 'ISLR por pagar'],
            ['codigo' => '002133', 'descripcion' => 'Retenciones ISLR por pagar'],
            ['codigo' => '002134', 'descripcion' => 'Anticipo de ISLR por pagar'],
            ['codigo' => '002135', 'descripcion' => 'IVA por pagar'],
            ['codigo' => '002136', 'descripcion' => 'Retenciones de IVA por pagar'],
            ['codigo' => '002137', 'descripcion' => 'IGTF por pagar'],
            ['codigo' => '002138', 'descripcion' => 'Aporte IVSS por pagar'],
            ['codigo' => '002139', 'descripcion' => 'Aporte PIE por pagar'],
            ['codigo' => '021311', 'descripcion' => 'Aporte FAOV por pagar'],
            ['codigo' => '021312', 'descripcion' => 'Aporte INCES por pagar'],
            ['codigo' => '021313', 'descripcion' => 'LOCTI por pagar'],
            ['codigo' => '021314', 'descripcion' => 'Impuesto sobre la Actividad Económica por pagar'],
            ['codigo' => '021315', 'descripcion' => 'Impuesto S/Propiedad Inmobiliaria por pagar'],
            ['codigo' => '021316', 'descripcion' => 'Impuesto Sobre Publicidad y Propaganda por pagar'],
            ['codigo' => '021317', 'descripcion' => 'Impuesto sobre Vehículos por pagar'],
            ['codigo' => '021318', 'descripcion' => 'Tasas varias por pagar'],
            ['codigo' => '021319', 'descripcion' => 'Ajuste a los Debitos Fiscales'],
            ['codigo' => '214', 'descripcion' => 'Obligaciones laborales'],
            ['codigo' => '002141', 'descripcion' => 'Nómina por pagar'],
            ['codigo' => '002142', 'descripcion' => 'Nómina Directivos por pagar'],
            ['codigo' => '002143', 'descripcion' => 'Beneficio de alimentación por pagar'],
            ['codigo' => '002144', 'descripcion' => 'Prestaciones e indemnizaciones por pagar'],
            ['codigo' => '002145', 'descripcion' => 'Vacaciones y bono vacacional por pagar'],
            ['codigo' => '002146', 'descripcion' => 'Utilidades y bono de fin de año por pagar'],
            ['codigo' => '002147', 'descripcion' => 'Retenciones de IVSS por pagar'],
            ['codigo' => '002148', 'descripcion' => 'Retenciones del PIE por pagar'],
            ['codigo' => '002149', 'descripcion' => 'Retenciones del FAOV por pagar'],
            ['codigo' => '021411', 'descripcion' => 'Retenciones del INCES por pagar'],
            ['codigo' => '215', 'descripcion' => 'Otros pasivo corrientes'],
            ['codigo' => '002151', 'descripcion' => 'Débito Fiscal IVA Ventas'],
            ['codigo' => '000003', 'descripcion' => 'PATRIMONIO NETO'],
            ['codigo' => '31', 'descripcion' => 'CAPITAL'],
            ['codigo' => '000311', 'descripcion' => 'Capital en acciones'],
            ['codigo' => '000312', 'descripcion' => 'Aportes por Capitalizar'],
            ['codigo' => '33', 'descripcion' => 'RESULTADO ACUMULADO'],
            ['codigo' => '000331', 'descripcion' => 'Resultado del Ejercicio'],
            ['codigo' => '000332', 'descripcion' => 'Resultados Acumulados'],
            ['codigo' => '000333', 'descripcion' => 'Otros Resultados Integrales'],
            ['codigo' => '32', 'descripcion' => 'RESERVAS'],
            ['codigo' => '000321', 'descripcion' => 'Reserva Legal'],
            ['codigo' => '000322', 'descripcion' => 'Reserva Voluntaria'],
            ['codigo' => '4', 'descripcion' => 'INGRESOS'],
            ['codigo' => '41', 'descripcion' => 'OPERACIONALES'],
            ['codigo' => '411', 'descripcion' => 'Ingresos operacionales'],
            ['codigo' => '004111', 'descripcion' => 'Venta de mercancía'],
            ['codigo' => '000042', 'descripcion' => 'OTROS INGRESOS'],
            ['codigo' => '000421', 'descripcion' => 'Otros ingresos'],
            ['codigo' => '000005', 'descripcion' => 'COSTOS'],
            ['codigo' => '000051', 'descripcion' => 'COSTOS OPERATIVOS'],
            ['codigo' => '000511', 'descripcion' => 'Compra de Materia Prima'],
            ['codigo' => '000512', 'descripcion' => 'Mano de Obra Directa'],
            ['codigo' => '000513', 'descripcion' => 'Compra de Mercancía para la venta'],
            ['codigo' => '000515', 'descripcion' => 'Descuentos y Devoluciones sobre compras'],
            ['codigo' => '000516', 'descripcion' => 'Fletes'],
            ['codigo' => '000517', 'descripcion' => 'Prorrata de IVA'],
            ['codigo' => '000518', 'descripcion' => 'Reparaciones de equipos de fábrica'],
            ['codigo' => '000519', 'descripcion' => 'Costos de Ventas'],
            ['codigo' => '6', 'descripcion' => 'GASTOS'],
            ['codigo' => '61', 'descripcion' => 'OPERACIONALES'],
            ['codigo' => '611', 'descripcion' => 'Gastos operacionales'],
            ['codigo' => '006111', 'descripcion' => 'Nómina Empleados'],
            ['codigo' => '006112', 'descripcion' => 'Nómina Directivos'],
            ['codigo' => '006113', 'descripcion' => 'Beneficio de alimentación'],
            ['codigo' => '006114', 'descripcion' => 'Prestaciones e indemnizaciones'],
            ['codigo' => '006115', 'descripcion' => 'Vacaciones y bono vacacional'],
            ['codigo' => '006116', 'descripcion' => 'Utilidades y bono de fin de año'],
            ['codigo' => '006117', 'descripcion' => 'IGTF'],
            ['codigo' => '006118', 'descripcion' => 'Aporte IVSS'],
            ['codigo' => '006119', 'descripcion' => 'Aporte PIE'],
            ['codigo' => '061121', 'descripcion' => 'Aporte FAOV'],
            ['codigo' => '061122', 'descripcion' => 'Aporte INCES'],
            ['codigo' => '061123', 'descripcion' => 'Anticipo y/o Estimada de ISLR'],
            ['codigo' => '061124', 'descripcion' => 'Impuesto sobre la Actividad Económica'],
            ['codigo' => '061125', 'descripcion' => 'Impuesto S/Propiedad Inmobiliaria'],
            ['codigo' => '061126', 'descripcion' => 'Impuesto Sobre Publicidad y Propaganda'],
            ['codigo' => '061127', 'descripcion' => 'Impuesto sobre Vehículos'],
            ['codigo' => '061128', 'descripcion' => 'Tasas varias'],
            ['codigo' => '061129', 'descripcion' => 'Comisiones a Vendedores'],
            ['codigo' => '061130', 'descripcion' => 'Servicios Contables, Auditoria y Administrativos'],
            ['codigo' => '061131', 'descripcion' => 'Servicios de Auditoría'],
            ['codigo' => '061132', 'descripcion' => 'Servicios legales'],
            ['codigo' => '061133', 'descripcion' => 'Gastos Bancarios'],
            ['codigo' => '061134', 'descripcion' => 'Servicios de encomiendas'],
            ['codigo' => '061135', 'descripcion' => 'Otros servicios'],
            ['codigo' => '061136', 'descripcion' => 'Insumos de oficina'],
            ['codigo' => '061137', 'descripcion' => 'Gastos de viajes'],
            ['codigo' => '061138', 'descripcion' => 'Donaciones y colaboraciones'],
            ['codigo' => '061139', 'descripcion' => 'Periódicos y revistas'],
            ['codigo' => '061140', 'descripcion' => 'Reparaciones ordinarias'],
            ['codigo' => '061141', 'descripcion' => 'Ajuste a los Debitos Fiscales'],
            ['codigo' => '061142', 'descripcion' => 'Dep. Mejoras a la Propiedad Arrendada'],
        ];

        foreach ($cuentas as $entry) {
            DB::table('cuentas_contables')->updateOrInsert($entry);
        }
    }
}
